document.querySelector('#archivo').addEventListener('change', () => {
    let pdffFile = document.querySelector('#archivo').files[0];
    let pdffFileURL = URL.createObjectURL(pdffFile);

    document.querySelector('#vistaprevia').setAttribute('src',pdffFileURL);

})