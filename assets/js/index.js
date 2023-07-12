window.addEventListener("DOMContentLoaded", function(){

    // create category
    let $categoryForm = document.getElementById("create-category");
    $categoryForm.addEventListener("submit", function(event){
        event.preventDefault();

        let $categoryName = document.getElementById("category-name").value;
        let $formName = document.getElementById("form-name").value;

        let $formData = new FormData();
        $formData.append('category-name', $categoryName);
        $formData.append('form-name', $formName);

        const options = {
            method: 'POST',
            body: $formData
        };

        fetch('/category-add', options)
            .then(response => response.json())
            .then(data => {
                console.log(data);
            });
    });


    // show the creat room form
    let createRoomBtns = document.querySelectorAll(".create-room-btn");
    for(let btn of createRoomBtns)
    {
        btn.addEventListener("click", function(event){
           let clicked = event.target;

           let catId = clicked.getAttribute("data-cat-id");

           let form = document.querySelector( `#create-room-${catId}`);

           form.classList.remove("hide");

           form.addEventListener("submit", function(event){
               event.preventDefault();
               let id = event.target.id;
               let name = document.querySelector(`#${id} #room-name`).value;
               let formName = document.querySelector(`#${id} #form-name`).value;
               let category_id = document.querySelector(`#${id} #category-id`).value;

               let $formData = new FormData();
               $formData.append('room-name', name);
               $formData.append('form-name', formName);
               $formData.append('category-id', category_id);

               const options = {
                   method: 'POST',
                   body: $formData
               };

               fetch('/room-add', options)
                   .then(response => response.json())
                   .then(data => {
                       console.log(data);
                   });

           });

           clicked.classList.add("hide");
        });

    }



});