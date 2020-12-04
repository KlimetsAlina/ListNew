$('#listModal').on('show.bs.modal', function(event) {
    var button  = $(event.relatedTarget) // Button that triggered the modal
    var watched = button.data('whatever') // Extract info from data-* attributes
    // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
    // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.

    var modal = $(this)
    modal.find('.modal-title').text('Добавление элемента')

    let myButton = document.getElementById('buttonForAdd');
    myButton.addEventListener('click', function(ev) {
        let name   = document.forms['addContent'].elements['contentName'].value;
        let author = document.forms['addContent'].elements['contentAuthor'].value;

        var bodyFormData = new FormData();
        bodyFormData.append('name', name);
        bodyFormData.append('author', author);
        bodyFormData.append('watched', watched);
        bodyFormData.append('type', window.location.pathname);
        axios({
            method:  'post',
            url:     '/addContent',
            data:    bodyFormData,
            headers: {'Content-Type': 'multipart/form-data'}
        })
            .then(function(response) {
                //handle success
                console.log(response);
            })
            .catch(function(response) {
                //handle error
                console.log(response);
            });
    })
});

let deleteButtons = document.querySelectorAll('.but-list');
deleteButtons.forEach(function(element) {
    element.addEventListener('click', function() {
        let innerATag = element.parentNode.innerHTML;
        let endIndex  = innerATag.indexOf('<button');
        let content   = innerATag.substring(0, endIndex); // Контент (имя и автор) списка, который надо будет вывести в модалке И отправить на Бэк
        console.log(content);
    });
});
