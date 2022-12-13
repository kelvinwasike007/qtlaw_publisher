import * as pdfMake from 'pdfmake/build/pdfmake';
//import * as pdfFonts from 'pdfmake/build/vfs_fonts';
pdfMake.fonts={
    Roboto: {
        normal: 'https://qtlaw.info/fonts/adc.ttf',
        bold: 'https://qtlaw.info/fonts/adc.ttf',
        italics: 'https://qtlaw.info/fonts/adc.ttf',
        bolditalics: 'https://qtlaw.info/fonts/adc.ttf'
      },
}


const save = async (data, file)=>{

    const doc = {
        content: [],
        defaultStyle:{
            font: 'Roboto'
        }
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