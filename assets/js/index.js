window.addEventListener("DOMContentLoaded", function(){

    let lastLi = document.querySelector("main ul li:last-of-type");
    if(lastLi)
    {
        lastLi.scrollIntoView(false);
    }


    // create category
    let $categoryForm = document.getElementById("create-category");
    $categoryForm.addEventListener("submit", function(event){
        event.preventDefault();

        let $categoryName = document.getElementById("category-name").value;
        let $formName = document.querySelector("#create-category #form-name").value;

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
                window.location.reload();
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
                       window.location.reload();
                   });

           });

           clicked.classList.add("hide");
        });
    }

    let $messageForm = document.getElementById("add-message");
    $messageForm.addEventListener("submit", function(event){
        event.preventDefault();

        let title = document.querySelector(`#message-title`).value;
        let formName = document.querySelector(`#add-message #form-name`).value;
        let content = document.querySelector(`#message-content`).value;
        let roomId = document.querySelector(`#room-id`).value;

        let $formData = new FormData();
        $formData.append('message-title', title);
        $formData.append('form-name', formName);
        $formData.append('message-content', content);
        $formData.append('room-id', roomId);

        const options = {
            method: 'POST',
            body: $formData
        };

        fetch('/message', options)
            .then(response => response.json())
            .then(data => {
                console.log(data);

                let li = document.createElement("li");
                let article = document.createElement("article");
                let header = document.createElement("header");
                let h4 = document.createElement("h4");
                let h3 = document.createElement("h3");
                let p = document.createElement("p");
                let footer = document.createElement("footer");
                let footerP = document.createElement("p");
                let author = document.createTextNode(data.message.author.username);
                let title = document.createTextNode(data.message.title);
                let content = document.createTextNode(data.message.content);
                let date = document.createTextNode(data.message.date);

                footerP.appendChild(date);
                footer.appendChild(footerP);
                p.appendChild(content);
                h3.appendChild(title);
                h4.appendChild(author);
                header.appendChild(h4);
                header.appendChild(h3);
                article.appendChild(header);
                article.appendChild(p);
                article.appendChild(footer);
                li.appendChild(article);

                let ul = document.querySelector("main > ul");

                ul.appendChild(li);
                li.scrollIntoView(false);
                document.querySelector(`#message-content`).value = "";

            });
    });

});