$(document).ready(function() {
    // Add Product To The List
    $(".add-product-btn").click(function(e) {
        e.preventDefault();

        var id = $(this).data("id");
        var name = $(this).data("name");
        var price = $(this).data("price");

        var html = `
        <tr>
            <td>${name}</td>
            <td> <input type="number" name="quantities[]" data-price="${price}" class="form-control prod-quan" min="1" value="1"> </td>
            <td class="prod-price">${price}</td>
            <td>
                <button type="button" id="product-${id}"  data-id="${id}"  class="btn btn-danger btn-sm remove-product-button">
                    <i class="fa fa-trash" aria-hidden="true"></i>
                </button>
            </td>
        </tr>`;

        // Append New Product
        $(".order-list").append(html);

        // Make The Add Button disabled
        $(this)
            .removeClass("btn-success")
            .addClass("btn-defalut disabled");

        // To Calculate Total Price
        calucTotal();
    });

    // Remove Product From The List
    $("body").on("click", ".remove-product-button", function() {
        var id = $(this).data("id");
        // To Show Add Button
        $("#product-" + id)
            .removeClass("btn-defalut disabled")
            .addClass("btn-success");

        // To Remove The Row Of This Product
        $(this)
            .closest("tr")
            .remove();

        // To Calculate Total Price
        calucTotal();
    });

    // Calcule Number Of one Product And Its Price
    $("body").on("keyup change", ".prod-quan", function(e) {
        e.preventDefault();
        var unitPrice = parseInt($(this).data("price"));
        var quantity = parseInt($(this).val());
        var totalPrice = unitPrice * quantity;
        // Display price of all products in the same type
        $(this)
            .closest("tr")
            .find(".prod-price")
            .html(totalPrice);

        // To Calculate Total Price
        calucTotal();
    });

    // Stop Action Of Disabled Button
    $(".disabled").click(function (e) {
        e.preventDefault();

    });
});

// Calculate The Total Price
function calucTotal() {
    var price = 0;
    $(".order-list .prod-price").each(function(index, element) {
        price += parseInt($(this).html());
    });

    $(".total-price").html(price);

    if(price > 0)
    {
        $("#add-order-form-btn").removeClass("disabled");
    }else{
        $("#add-order-form-btn").addClass("disabled");
    }
}
