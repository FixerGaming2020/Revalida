$('#input-excel').change(function(e){
    var reader = new FileReader();

    reader.readAsArrayBuffer(e.target.files[0]);

    reader.onload = function(e){
        var data = new Uint8Array(reader.result);
        var wb = XLSX.read(data,{type:'array'})
        
    }
});