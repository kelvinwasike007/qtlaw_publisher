<script>
    import { onMount } from "svelte";

    export let data
    let editor;
    let quill;
    const {pubs} = data
    var publication = pubs[0]
      
    onMount(async () => {
          const { default: Quill } = await import("quill");
      
       quill = new Quill(editor, {
        theme: "bubble",
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
      quill.setContents(JSON.parse(publication.publication))
    });
</script>

<div class="h-full flex flex-col">
    <div class="flex">
        <div class="font-medium flex-auto">Publication Title: {publication.title}</div>
        <div class="mr-4 text-xs">Author: {publication.user_id}</div>
    </div>
    <div class="editor-wrapper flex-auto h-full w-full p-4 flex flex-col  ">
        <div bind:this={editor} class="" />
    </div>
</div>