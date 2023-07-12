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



});