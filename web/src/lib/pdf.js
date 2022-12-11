


const save = async (data, file)=>{
    const {default: pdfMake} = await import('pdfmake/build/pdfmake')
    const {default: pdfFonts} = await import('pdfmake/build/vfs_fonts')
    pdfMake.vfs = pdfFonts.pdfMake.vfs

    const doc = {
        content: []
    }
    console.log(data);
    var sentence = ''
    var attributes = {}
    var img = false
    data.forEach(line => {    
        if (line.insert == '\n'){
            console.log(sentence);
            var lastAttr = Object.assign({}, attributes, line.attributes)
            
            if(img){
                doc.content.push({
                    image: sentence,
                    alignment: 'align' in lastAttr ? lastAttr.align : 'justify'
                })
                sentence =''
                attributes = {}
                return
            }
            
            doc.content.push({text:sentence, 
                bold: 'bold' in lastAttr ? true : false,
                decoration: 'underline' in lastAttr ? 'underline': '',
                fontSize: 10,
                alignment: 'align' in lastAttr ? lastAttr.align: 'justify'
                //underline: 'underline' in line.attributes                
        })
        sentence =''
        attributes = {}
        }else{
            //image mode
            if(typeof(line.insert) == 'object'){
                sentence += line.insert.image
                img=true
                console.log('img-set');
            }else{
                img=false
            }
            
            sentence += line.insert
            attributes = line.attributes
        }
    });

    console.log(doc)    
    pdfMake.createPdf(doc).download(file)
}

export {save}