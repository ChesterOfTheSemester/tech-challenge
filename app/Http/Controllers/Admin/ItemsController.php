<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Download;
use App\Models\Info;
use App\Models\Item;
use App\Models\Weblink;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\Request;

class ItemsController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('items/Index', [
            'items' => Item::query()->oldest()->limit(10)->get(),
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('items/Create', []);
    }

    public function store()
    {
        $type = match(request()->input('content_type')) {
            'info' => new Info([
                'header' => request('content.header'),
                'content' => request('content.content'),
            ]),
            'download' => new Download([
                'url' => request('content.url'),
                'button_text' => request('content.button_text', 'Download')
            ]),
            'WEBLINK' => new Weblink([
                'url' => request('content.url'),
                'button_text' => request('content.button_text', 'Weblink')
            ]),
        };

        $type->save();
        $type->item()->save(new Item(request()->only(['name', 'description'])));

        return redirect()->route('admin.items.index')->with('message', 'Successfully Created Item');
    }

    public function edit(Item $item): Response
    {
        return Inertia::render('items/Edit', [
            'item' => $item->load('content'),
        ]);
    }

    public function update(Item $item): RedirectResponse
    {
        $item->forceFill(request()->only(['name', 'description']));

        switch($item->content_type) {
            case 'info':
                $item->content->header = request('content.header');
                $item->content->content = request('content.content');
                break;
            case 'download':
            case 'WEBLINK':
                $item->content->url = request('content.url');
                break;
        }

        $item->push();

        return redirect()->route('admin.items.index')->with('message', 'Successfully Updated Item');
    }
    public function destroy(Item $item): RedirectResponse
    {
        if ($item->deleted_at !== null || $item->is_protected) {
            return redirect()->route('admin.items.index')
                ->with('error', 'Item cannot be deleted.');
        }

        $item->delete();

        return redirect()->route('admin.items.index')->with('success', 'Item deleted successfully');
    }

    public function search(Request $request): Response
    {
        $query = $request->input('q');
        $type = $request->input('type');

        $items = Item::query()
            ->when($query, function ($q) use ($query) {
                $q->where('name', 'like', "%{$query}%");
            })
            ->when($type, function ($q) use ($type) {
                $q->where('content_type', $type);
            })
            ->oldest()
            ->get();

        return Inertia::render('items/Index', [
            'items' => $items,
            'query' => $query,
            'type' => $type
        ]);
    }
}
