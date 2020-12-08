let watched = '0';
$('#listModal').on('show.bs.modal', function(event) {
    let button = $(event.relatedTarget); // Button that triggered the modal
    watched    = button.data('watched') // Extract info from data-* attributes
    $('#contentName').val('');
    $('#contentAuthor').val('');
});

let formForAdd = document.getElementById('addContent');
formForAdd.addEventListener('submit', function(e) {
    e.preventDefault();

    let name   = document.forms['addContent'].elements['contentName'].value;
    let author = document.forms['addContent'].elements['contentAuthor'].value;

    let bodyFormData = new FormData();
    bodyFormData.append('name', name);
    bodyFormData.append('author', author);
    bodyFormData.append('watched', watched);
    bodyFormData.append('type', (window.location.pathname).substring(1)); // TODO: change it

    axios.post('/addContent', bodyFormData)
        .then(function() {
                console.log('Добавлено!');
                $('#listModal').trigger('click');
                return false;
            }
        ).catch((error) => {
        console.log(error.message);
    });
})

// $("#myModal").modal('hide').on('hidden.bs.modal', functionThatEndsUpDestroyingTheDOM);

let content       = '';
let deleteButtons = document.querySelectorAll('.but-list');
deleteButtons.forEach(function(element) {
    element.addEventListener('click', function(e) {
        e.preventDefault();
        let innerATag = element.parentNode.innerHTML;
        let endIndex  = innerATag.indexOf('<button');
        content       = innerATag.substring(0, endIndex); // Контент (имя и автор) списка, который надо будет вывести в модалке И отправить на Бэк
    });
});

$('#listModalDelete').on('show.bs.modal', function() {
    let modal = $(this);
    modal.find('.modal-body').text(content)

    let formForDelete = document.getElementById('deleteContent');
    formForDelete.addEventListener('submit', function(ev) {
        ev.preventDefault();

        let dash   = content.indexOf(' - '); // TODO change this trouble
        let name   = (content.substring(0, dash)).trim();
        let author = (content.substring(dash + 2)).trim();

        let bodyFormData = new FormData();
        bodyFormData.append('name', name);
        bodyFormData.append('author', author);
        bodyFormData.append('type', (window.location.pathname).substring(1)); // TODO: change it

        axios({
            method:  'post',
            url:     '/deleteContent',
            data:    bodyFormData,
            headers: {'Content-Type': 'multipart/form-data'}
        })
            .then(function() {
                console.log('Удалено');
                $('#listModalDelete').trigger('click');

            })
            .catch(function(error) {
                console.log(error);
            });
    });
});
