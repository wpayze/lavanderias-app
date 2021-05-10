//PONELE JAVASCRIPT EN VS CODE PARA QUE SE VEA BIEN.

$('#clientsearch').select2({
    placeholder: 'Seleccione al Cliente',
    ajax: {
        url: '/ajax-client-search',
        dataType: 'json',
        delay: 250,
        processResults: function (data) {
            return {
                results: $.map(data, function (item) {
                    return {
                        text: item.name,
                        id: item.id
                    }
                })
            };
        },
        cache: true
    }
});

let addServiceType = () => {
    let service_type_select = document.getElementById("service_type");
    let index = service_type_select.selectedIndex;
    let text = service_type_select[index].text;
    let value = service_type_select.value;

    service_type_select.selectedIndex = 0;

    if (existingServiceTypes.includes(value) || value == 0) {
        return;
    }

    existingServiceTypes.push(value);

    let service_types_div = document.getElementById("service_types_div");

    service_types_div.innerHTML += "\
        <div>\
            <input class='hidden' type='text' name='service_types[]' value='" + value + "' />\
            <div class='bg-blue-100 border-t border-b border-blue-500 text-blue-700 px-4 py-3' role='alert'>\
                <p class='font-bold inline'>"+ text +"</p> <i class='fas fa-trash cursor-pointer' onclick='deleteServiceType(\""+value+"\", this)'></i>\
            </div>\
        </div>\
    ";
}

let deleteServiceType = (value, trash) => {
    existingServiceTypes = existingServiceTypes.filter(a => a != value);
    trash.parentElement.parentElement.outerHTML = "";
}

let addPieceType = () => {
    let piece_type_select = document.getElementById("piece_type");
    let index = piece_type_select.selectedIndex;
    let text = piece_type_select[index].text;

    let price = piece_type_select[index].getAttribute("price");
    let charge_by = piece_type_select[index].getAttribute("charge_by");

    let value = piece_type_select.value;

    piece_type_select.selectedIndex = 0;

    if (existingPieceTypes.includes(value) || value == 0) {
        return;
    }

    existingPieceTypes.push(value);

    let piece_types_div = document.getElementById("piece_types_div");

    var div = document.createElement("div");
    div.classList.add("mt-3");

    div.innerHTML =
    "<p class='text-lg font-bold'>" + text + "</p>\
        <div class='grid grid-cols-12'>\
            <div class='col-span-12 lg:col-span-4'>\
                <input type='number' class='hidden' value='"+value+"' name='piece_types["+index+"][id]' />\
                <label class='block text-sm font-medium text-gray-700'>Cantidad de Piezas</label>\
                <input type='number' min='0' class='form-input piezas' name='piece_types["+index+"][quantity]'\
                "+ (charge_by == "pieza" ? " onchange='updateTotalType(this)' " : "") +"/>\
            </div>\
            <div class='col-span-12 lg:col-span-4'>\
                <label class='block text-sm font-medium text-gray-700'>Peso de las Piezas (Libras)</label>\
                <input type='number' min='0' class='form-input peso' name='piece_types["+index+"][weight]'\
                " + (charge_by == "peso" ? " onchange='updateTotalType(this)' " : "")+ "/>\
            </div>\
            <div class='col-span-12 lg:col-span-4'>\
                <label class='block text-sm font-medium text-gray-700'>Precio por "+charge_by+"</label>\
                <input type='number' min='0' onchange='updateTotalPrice(this, \""+charge_by+"\")' class='form-input price' value="+price+" name='piece_types["+index+"][price]' />\
                <i class='fas fa-trash cursor-pointer' onclick='deletePieceType(\""+value+"\", this)'></i>\
            </div>\
        </div>\
        <p class='text-sm font-bold'>Total: L. <span class='totalpieza'>0.00</span> <p>\
        <br><hr>";

    piece_types_div.appendChild(div);
}

let deletePieceType = (value, trash) => {
    existingPieceTypes = existingPieceTypes.filter(a => a != value);
    trash.parentElement.parentElement.parentElement.outerHTML = "";
}

let updateTotalType = (inp) => {

    let master_div = inp.closest(".mt-3");

    let value = inp.value; //Ya sean las libras o las piezas
    let totalpieza = master_div.querySelector(".totalpieza");
    let price = master_div.querySelector(".price").value;

    totalpieza.innerHTML = (value * price).toFixed(2);
    updateGrandTotal();
}

let updateTotalPrice = (inp, charge_by) => {

    let master_div = inp.closest(".mt-3");

    let price = inp.value;
    let totalpieza = master_div.querySelector(".totalpieza");

    let value;
    if (charge_by == "peso")
        value = master_div.querySelector(".peso").value;
    else if (charge_by == "pieza")
        value = master_div.querySelector(".piezas").value;


    totalpieza.innerHTML = (value * price).toFixed(2);
    updateGrandTotal();
}

let updateGrandTotal = () => {
    let total = document.getElementById("total");
    let totalsuma = 0, totalfloat;

    document.querySelectorAll(".totalpieza").forEach( (totalpieza) => {
        totalfloat = parseFloat(totalpieza.innerHTML);
        totalsuma += totalfloat;
    });

    total.value = totalsuma;
}
