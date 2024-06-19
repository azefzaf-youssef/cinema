
let old_lines ;
let image;
let composant;
let withDelete=false;



function generateBtnDelete(element, YY, XX = null, rect = null, right = false) {

    let btn_delete = document.createElement("div");

    btn_delete.innerHTML ="x";
    btn_delete.classList.add("line");
    btn_delete.classList.add("delete-composant");
    btn_delete.dataset.id = element.id;
    btn_delete.style.top = YY - 10;
    btn_delete.style.heigth = 1;
    btn_delete.style.color = "red";
    btn_delete.style.cursor = "pointer";
    if (right) {
        btn_delete.style.left = XX + (-element.eventClientX + rect.right) + 150;

    } else {
        btn_delete.style.left = -165;
    }
    btn_delete.style.zIndex = 200;

    return btn_delete;

}

function generateDescription(element, YY, XX = null, rect = null, right = false) {
    let description = document.createElement("div");

    description.innerHTML = element.description;
    description.dataset.id = element.id;
    description.id = "description-"+element.id;
    description.classList.add("line");
    description.style.top = YY - 10;
    description.style.heigth = 1;
    description.style.width = 90;
    if (right) {
        description.style.left = XX + (-element.eventClientX + rect.right) + 57;

    } else {
        description.style.left = -140;

    }
    description.style.zIndex = 200;

    return description;
}

function generateLine(YY, XX, element, rect = null, right = false) {

    let div = document.createElement("div");

    div.innerHTML += "";
    div.classList.add("line")
    div.style.top = YY;
    div.style.heigth = 1;
    if (right) {
        div.style.width = 47 - (element.eventClientX - rect.right);
        div.style.left = XX;
    } else {
        div.style.width = XX + 47;
        div.style.left = -50;
    }
    div.style.border = "1px solid";
    div.style.zIndex = 200;

    return div;
}

function generateDot(YY, XX) {

    let span = document.createElement("span");

    span.classList.add("dot")
    span.style.top = YY - 2;
    span.style.heigth = 1;
    span.style.left = XX - 3;
    span.style.zIndex = 200;
    span.style.position = "absolute";

    return span;

}

function showComposant(line=old_lines,img=image,composants=composant,withDelete=withDelete) {

    withDelete = withDelete;
    composant = composants;

    if(line){
    old_lines = line;
    image = img;

    old_lines.innerHTML = '';
    old_lines.appendChild(image);
    }

    composant.forEach(element => {
        var rect = element.rect;

        var YY = element.YY;
        var XX = element.XX;
        let line = document.getElementById("lines");
        let div = document.createElement("div");
        let description = document.createElement("div");
        let span = document.createElement("span");

        if (element.eventClientX < screen.width / 2) {

            if (withDelete) {

            btn_delete = generateBtnDelete(element, YY)
            line.appendChild(btn_delete);

            }

            description = generateDescription(element, YY)
            line.appendChild(description);

            div = generateLine(YY, XX)
            line.appendChild(div);


            span = generateDot(YY, XX);
            line.appendChild(span);

        } else {

            if (withDelete) {

            btn_delete = generateBtnDelete(element, YY, XX, rect, true);
            line.appendChild(btn_delete);

            }

            description = generateDescription(element, YY, XX, rect, true)
            line.appendChild(description);

            div = generateLine(YY, XX, element, rect, true);
            line.appendChild(div);

            span = generateDot(YY, XX);
            line.appendChild(span);

        }

    });

    return composant ;

}

window.showComposant = showComposant;

