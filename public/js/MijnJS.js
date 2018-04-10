//window.onload= function () {
//var upbutton = document.getElementById('fileup');
//console.log(upbutton);
//upbutton.innerHTML = 'test';
//};

window.onload = function () {
    
    
    var input = document.getElementById('fileup');
    console.log(input);
    var label = input.nextElementSibling,
            labelVal = label.innerHTML;
    console.log(labelVal);
    
    // Gekozen bestandsnaam tonen naast uploadknop
    input.addEventListener('change', function (e)
    {
        var fileName = '';
        if (this.files && this.files.length > 1)
            fileName = (this.getAttribute('data-multiple-caption') || '').replace('{count}', this.files.length);
        else
            fileName = e.target.value.split('\\').pop();

        if (fileName)
            label.querySelector('span').innerHTML = fileName;
        else
            label.innerHTML = labelVal;
    });

    // C:\fakepath verwijderen uit bestandsnaam
    document.getElementById("fileup").onchange = function () {
        var path = this.value;
        var path = path.replace(/\\/g, '/').replace(/.*\//, '');
        document.getElementById("uploadFile").value = path;

    };
};
