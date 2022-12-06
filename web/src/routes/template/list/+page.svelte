<script>
    import { config } from "../../../lib/config";
    


    export let data;
    console.log(data);
    async function deletes(e,id) {
        e.preventDefault()
        await fetch(`${config.api}/template/delete/${id}`, {method: 'DELETE', headers: {'Content-Type': 'application/json'}} )
        window.location.reload()
    }
</script>

<div class=" p-4 h-full">
    <div  class="text-2xl flex justify-center font-semibold">
        <div>LIST OF TEMPLATES</div>
    </div>
    <div class="flex flex-col items-center space-y-6">
        {data.pubs.length == 0 ? "No Publications Yet" :""}
        {#each data.pubs as set}
        <a href={`/view/${set.title}`} class="flex w-3/4 bg-gray-100 hover:bg-gray-200 p-4 cursor-pointer">
            <div class="flex-auto">
                <div class="font-bold text-"> {set.title}</div>
                <div class="flex flex-col space-y-2">
                    <a href={`/publications/template/${set.title}`} class="btn text-white btn-info btn-xs rounded-none">create publication</a>
                    <a href="./list" on:click={(e, id)=>deletes(e, set.id)} class="btn btn-xs rounded-none text-white btn-warning">Delete</a>
                </div>
            </div>
            
            <div>
                <div>Created On: {set.created_at}</div>
                <div>Last Modified: {set.updated_at}</div>
            </div>
            
        </a>
    {/each}
    </div>
</div>