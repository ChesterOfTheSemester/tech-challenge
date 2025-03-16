import { router } from '@inertiajs/vue3';
import { Config, RouteParams, route } from 'ziggy-js';

declare global {
    function route(): Config;
    function route(name: string, params?: RouteParams<typeof name> | undefined, absolute?: boolean, method?: 'GET' | 'POST' | 'DELETE' | 'PATCH'): any;
}

export function deleteRoute(name: string, params?: RouteParams<typeof name>, absolute?: boolean) {
    if (confirm('Please confirm that you want to delete this item'))
        return router.delete(route(name, params, absolute), {
            preserveState: true,
            onFinish: () => location.reload(),
        });
}
