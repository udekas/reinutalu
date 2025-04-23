import type { ColumnDef } from '@tanstack/vue-table';

export type User = {
    id: number;
    name: string;
    email: string;
    registered_events_count: number;
};

export const columns: ColumnDef<User>[] = [
    {
        accessorKey: 'name',
        header: 'Name',
    },
    {
        accessorKey: 'email',
        header: 'Email',
    },
    {
        accessorKey: 'registered_events_count',
        header: 'Registered Events',
    },
];
