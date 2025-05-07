<script setup lang="ts">
import { Sidebar, SidebarHeader, SidebarMenu, SidebarMenuItem, SidebarMenuButton, SidebarContent, SidebarFooter } from '@/components/ui/sidebar';
import AppLogo from '@/components/AppLogo.vue';
import NavMain from '@/components/NavMain.vue';
import NavFooter from '@/components/NavFooter.vue';
import NavUser from '@/components/NavUser.vue';
import { LayoutGrid } from 'lucide-vue-next';
import { Link, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';

// Get the page data passed by Inertia
const page = usePage();

// Make sure the user object is available before using it
const user = page.props.auth?.user; // Use optional chaining to avoid errors if auth is undefined

// Compute the navigation items based on the user's role
const mainNavItems = computed(() => {
    if (user?.is_admin) {
        return [
            { title: 'Dashboard', href: '/admin/dashboard', icon: LayoutGrid },
            { title: 'Users', href: '/users', icon: LayoutGrid },
        ];
    }

    return [
        { title: 'Dashboard', href: '/dashboard', icon: LayoutGrid },
    ];
});
</script>

<template>
    <Sidebar collapsible="icon" variant="inset">
        <SidebarHeader>
            <SidebarMenu>
                <SidebarMenuItem>
                    <SidebarMenuButton size="lg" as-child>
                        <Link :href="route(user?.is_admin ? 'admin.dashboard' : 'dashboard')">
                            <AppLogo />
                        </Link>
                    </SidebarMenuButton>
                </SidebarMenuItem>
            </SidebarMenu>
        </SidebarHeader>

        <SidebarContent>
            <!-- Render the correct menu items based on is_admin -->
            <NavMain :items="mainNavItems" />
        </SidebarContent>

        <SidebarFooter>
            <NavFooter :items="[]" />
            <NavUser />
        </SidebarFooter>
    </Sidebar>

    <slot />
</template>
