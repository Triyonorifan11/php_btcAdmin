// const keysearch = document.getElementById('keysearch');
// const button_search = document.getElementById('button-search');
// const table = document.getElementById('table');
const box_autocomplete = document.getElementById('box-autocomplete');
const body_autocomplete = document.getElementById('body-autocomplete');

keysearch.addEventListener('keyup', function () {

    // buat objek ajax
    // console.log(keysearch.value);

    fetch('http://localhost:1109/pemWeb/btc/api/autoComplete.php?keysearch=' + keysearch.value)
        .then(response => response.json())
        .then(data => {
            // console.log(data)
            renderAutoComplete(box_autocomplete, body_autocomplete, data)
        });

});

function renderAutoComplete(container, target, data) {
    container.style.display = 'block';
    html = ""

    data.forEach((value, index) => {
        // console.log(value);
        let el = `<div>${value.id}</div>`
        html += el;
    })

    target.innerHTML = html;
}