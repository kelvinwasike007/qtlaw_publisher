<script>
    import { pdfExporter } from "quill-to-pdf";
    import { saveAs } from 'file-saver';
    import { onMount } from "svelte";
    import {save} from '../../../../lib/pdf'
    export let data
    let editor;
    let tmp;
    let quill;
    let q2
    const {pubs} = data
    var publication = pubs[0]
      
    onMount(async () => {
          const { default: Quill } = await import("quill");

          
      
       quill = new Quill(editor, {
        theme: "bubble",
        placeholder: "Compose Publication...",
        
      });
      quill.setContents(JSON.parse(publication.publication))
      q2 = new Quill(tmp,{})

      q2.setContents(JSON.parse(publication.publication))
    });

    async function saveAsPdf() {
      console.log(save(JSON.parse(publication.publication), `${publication.title}.pdf`));
    }
</script>

<div class="h-full flex flex-col">
    <div class="flex">
        <div class="font-medium flex-auto">Publication Title: {publication.title}</div>
        <div class="mr-4 text-xs">Author: {publication.user_id}</div>
    </div>
    <div class="flex justify-center p-4">
      <button class="btn btn-xs btn-info" on:click={saveAsPdf}>SAVE AS PDF</button>
    </div>
    <div class="editor-wrapper flex-auto h-full w-full p-4 flex flex-col  ">
        <div bind:this={editor} class="" />
    </div>
</div>

<div class="flex justify-center p-4">
  <button class="btn btn-xs btn-info" on:click={saveAsPdf}>SAVE AS PDF</button>
</div>

<div class="hidden" bind:this={tmp} />