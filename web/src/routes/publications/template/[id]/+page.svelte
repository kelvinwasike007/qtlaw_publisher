<script>
    import { onMount } from "svelte";
    import { config } from "../../../../lib/config";
    export let data
    let editor;
    let quill;
    const {pubs} = data
    var publication = pubs[0];
    let Title;
    let saved = '';
      
    onMount(async () => {
          const { default: Quill } = await import("quill");
      
       quill = new Quill(editor, {
        theme: "snow",
        placeholder: "Compose Publication...",
        formats: [
      'bold',
      'italic',
      'underline',
      'strike',
      'align',
      'list',
      'indent',
      'size',
      'header',
      'link',
      'image',
      'video',
      'color',
      'background',
      'clean',
    ],
      });
      quill.setContents(JSON.parse(publication.template))
    });

    function preview() {
      window.location.href='/preview'
    }
    function _new() {
      window.location.reload()
    }

    async function save(){
      var delta = quill.getContents();
      var body = {
        user_id : 'kelvin',
        title: Title,
        publication: JSON.stringify(delta.ops)
      }
      body = JSON.stringify(body)
      var value = await fetch(config.api+'publication', {method:'POST', body:body, headers:{'Content-Type':'application/json'}});
      console.log(await value.json())
      saved = 'Saved'
    }
</script>

<style>
  @import 'https://cdn.quilljs.com/1.3.6/quill.snow.css';
</style>

<div class="h-full flex flex-col">

    <div class="flex h-full">
      <div class="editor-wrapper flex-auto h-full w-full p-4 flex flex-col  ">
        <div bind:this={editor} class="" />
    </div>
    <div class="w-1/4 h-full flex flex-col  bg-gray-200 bg-gray-100 mr-4 p-4 mb-4">
      <div class="flex flex-col space-y-4">
        <div class="font-medium">PAGE TITLE</div>
        <div><input bind:value={Title} type="text" class="input border-gray-300" placeholder="Enter Publication Title"></div>
        <div class="mt-4"><button on:click={save} class="btn btn-success btn-block text-white">Save</button></div>
        <div class="mt-4"><button on:click={_new} class="btn btn-info btn-block text-white">New</button></div>
        <div class="mt-4"><button on:click={preview} class="btn btn-primary btn-block text-white">Preview</button></div>
      </div>
      <div class="mt-4 bg-blue-500 p-2 text-white">status: {saved}</div>
    </div>
    </div>
</div>