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
