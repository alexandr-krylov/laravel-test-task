/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Other/javascript.js to edit this template
 */
{
    let removeAttributeButtons = document.getElementsByClassName("remove-attribute");
    for (let button of removeAttributeButtons) {
        button.addEventListener("click", function () {
            this.closest(".row").remove();
        });
    }
}
{
    let addAttributeButton = document.getElementById("addAttribute");
    addAttributeButton.addEventListener("click", function () {
        let newAttribute = document.createElement("div");
        newAttribute.className = "row";
        newAttribute.innerHTML = '<div class="col">' +
                '<label class="form-label">Название<input type="text" name="title[]" class="form-control">' +
                '</label>' +
                '</div>' +
                '<div class="col">' +
                '<label class="form-label">Значение<input type="text" name="value[]" class="form-control">' +
                '</label>' +
                '</div>' +
                '<div class="col">' +
                '<button type="button" class="btn mt-4 remove-attribute"><i class="bi bi-trash"></i></button>' +
                '</div>';
        newAttribute.lastChild.firstChild.addEventListener("click", function () {
            this.closest(".row").remove();
        });
        let attribtes = document.getElementById("attributes");
        attribtes.append(newAttribute);
    });
}
{
    let newProductForm = document.getElementById("newProduct");
    let newProductSubmitButton = document.getElementById("newProductSubmit");
    newProductSubmitButton.addEventListener("click", function () {
        newProductForm.submit();
    });
}
{

    let productRows = document.querySelectorAll("#data [data-id]");
    let showProductTitle = document.getElementById("showProductModalLabel");
    let showProductModal = document.getElementById("showProductModal");
    let showProductArticle = document.getElementById("showArticle");
    let showProductName = document.getElementById("showName");
    let showProductStatus = document.getElementById("showStatus");
    let showProductAttributes = document.getElementById("showAttributes");
    console.log(showProductModal);
    for (let row of productRows) {
        row.addEventListener("click", function () {
            let id = this.getAttribute("data-id")
            console.log(id);
            fetch("product/" + id)
                    .then(response => response.json())
                    .then(result => {
                        showProductTitle.innerHTML = result.name;
                        showProductArticle.innerHTML = result.article;
                        showProductName.innerHTML = result.name;
                        showProductStatus.innerHTML = result.status;
                        console.log(result.data);
                        showProductAttributes.innerHTML = result.data.join("<br>");
//                        showProductModal.setAttribute("style", "display: block");
                    });
        });
    }
    console.log(productRows);
}
