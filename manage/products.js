$(function() {

    /*
        initComponents
    */
    function initComponents(json) {
        console.log('initComponents');
        initDeleteButtons();
    }

    /*
        delete buttons
    */
    function initDeleteButtons() {

        $('.btn-danger').click(function() {

            if (!confirm('Are you sure you want to delete this product?')) {
                return false;
            }

            var productID = $(this).val();

            console.log('Product ID: ' + productID);

            var productData = {
                product_id: productID
            };

            $.ajax({
                type: 'POST',
                url: 'http://hohutacoffeeshop.atwebpages.com/manage/delete-product.php',
                data: productData,
                success: function(data) {
                    console.log("success " + data);
                    table.ajax.reload(function(data) {
                        initComponents(json);
                    });
                },
                error: function(data, status, xhr) {
                    console.log("failure");
                }
            });
        });
    }


    /*
        setup datatable & load data
    */
    var table = $('#product-table').DataTable({
        ajax: 'http://hohutacoffeeshop.atwebpages.com/manage/get-products.php',
        initComplete: function(settings, json) {
            console.log("initComplete: " + json.data.length);
            initComponents(json);
        },
        columns: [
            { 'data': 'product_name' },
            { 'data': 'product_price' },
            { 'data': 'product_image' },
            { 'data': 'delete' }
        ]
    });

    /*
        add product
    */
    $('#add-product').click(function() {
        var productName = $('#product-name').val();
        var productPrice = $('#product-price').val();
        var productImage = $('#product-image').val();


        var productData = {
            product_name: productName,
            product_price: productPrice,
            product_image: productImage
        };

        $.ajax({
            type: 'POST',
            url: 'http://hohutacoffeeshop.atwebpages.com/manage/add-product.php',
            data: productData,
            success: function(json) {
                console.log("success " + json);
                table.ajax.reload(function(json) {
                    initComponents(json);
                });
            },
            error: function(data, status, xhr) {
                console.log("failure");
            }
        });

    });

    /*
        update salary
    */
    $('#price-save').click(function() {

        var productID = $('#products').val();
        var productPrice = $('#price').val();


        var priceData = {
            product_id: productID,
            product_price: productPrice
        };

        $.ajax({
            type: 'POST',
            url: 'http://hohutacoffeeshop.atwebpages.com/manage/set-products.php',
            data: priceData,
            success: function(json) {
                console.log("success: " + json.result);
                console.log(json);
                table.ajax.reload(function(json) {
                    initComponents(json);
                });
            },
            error: function(json, status, xhr) {
                console.log("failure");
            }
        });
    });

});