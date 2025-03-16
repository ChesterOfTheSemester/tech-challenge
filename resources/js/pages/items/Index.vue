<script setup lang="ts">
import { Button } from '@/components/ui/button';
import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow } from '@/components/ui/table';
import AppLayout from '@/layouts/AppLayout.vue';
import type { BreadcrumbItem } from '@/types';
import { Head, Link } from '@inertiajs/vue3';
import { defineProps } from 'vue';
import { route } from 'ziggy-js';
import { deleteRoute } from '@/types/ziggy';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: '/admin/dashboard',
    },
    {
        title: 'Items',
        href: '/admin/items',
    },
];

defineProps<{
    items: Array;
    query: String;
    type: String;
}>();
</script>

<template>
    <Head title="Dashboard" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="flex justify-between">
                    <h3 class="text-2xl">Items</h3>
                    <Button :as="Link" :href="route('admin.items.create')">Create Item</Button>
                </div>

                <form method="GET" :action="route('admin.items.search')" class="mt-6 flex gap-2 items-center">
                    <input
                        type="text"
                        name="q"
                        :value="query || ''"
                        v-model="query"
                        placeholder="Search items..."
                        class="border px-2 py-1 text-black"
                    />

                    <select name="type" :value="type" class="border px-2 py-1 text-black">
                        <option :selected="!type" value="">All Types</option>
                        <option value="info">Info</option>
                        <option value="download">Download</option>
                        <option value="WEBLINK">Weblink</option>
                    </select>

                    <Button type="submit">Search</Button>
                </form>

                <div class="mt-8 flex flex-col">
                    <Table>
                        <TableHeader>
                            <TableRow>
                                <TableHead>Name</TableHead>
                                <TableHead>Type</TableHead>
                                <TableHead>Active</TableHead>
                                <TableHead class="text-right"> Actions </TableHead>
                            </TableRow>
                        </TableHeader>
                        <TableBody>
                            <TableRow v-for="item in items" :key="item.id">
                                <TableCell>
                                    {{ item.name }}
                                </TableCell>
                                <TableCell>{{ item.content_type }}</TableCell>
                                <TableCell>{{ item.active ? 'Active' : 'Inactive' }}</TableCell>
                                <TableCell class="text-right">
                                    <Button :as="Link" variant="link" :href="route('admin.items.edit', item.id)"> Edit </Button>
                                    <Button variant="destructive" @click.prevent="deleteRoute('admin.items.destroy', item.id)"> Delete </Button>
                                </TableCell>
                            </TableRow>
                        </TableBody>
                    </Table>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
