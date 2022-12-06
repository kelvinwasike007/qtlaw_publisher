<script>
    import {page} from '$app/stores';
</script>

<div class="h-full flex flex-col items-center justify-center">
    <div class="font-bold text-2xl">{$page.status}</div>
    <div class="font-medium text-xl">{$page.error.message}</div>
</div>