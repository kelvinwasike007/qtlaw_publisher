<script>
    export let data;
    console.log(data)
    import {base} from '$app/paths';
</script>

<div class=" p-4 h-full">
    <div  class="text-2xl flex justify-center font-semibold">
        <div>LIST OF PUBLICATIONS</div>
    </div>
    <div class="flex flex-col items-center space-y-6">
        {data.pubs.length == 0 ? "No Publications Yet" :""}
        {#each data.pubs as set}
        <a href={`${base}/publications/view/${set.id}`} class="flex w-3/4 bg-gray-100 hover:bg-gray-200 p-4 cursor-pointer">
            <div class="flex-auto">
                <div class="font-bold text-"> {set.title}</div>
                <div>By: {set.user_id.toUpperCase()}</div>
            </div>
            
            <div>
                <div>Created On: {set.created_at}</div>
                <div>Last Modified: {set.updated_at}</div>
            </div>
            
        </a>
    {/each}
    </div>
</div>