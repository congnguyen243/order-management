(function ($, app) {

    var homeCls = function () {

        var el = {};
    
        this.run = function () {
            this.init();
            this.bindEvents();
        };

        this.init = function () {
            $('.datepicker').datepicker({ dateFormat: 'yy-mm-dd' });
            $('#new-order-btn').on('click',function(){
                $('#myModal').show();
            })
            $('#close-form-order').on('click',function(){
                $('#myModal').hide();
            })

            // When the user clicks anywhere outside of the modal, close it
            var modal = $('#myModal').get(0);
            
            window.onclick = function(event) {
                if (event.target == modal ) {
                    modal.style.display = "none";
                }
            }

            var seAll = $('#selectAllProduct');
            
            var seItem = $('.item_check');
            seItem.prop('checked', false);
            
            //selectAll
            seAll.click(function(){
                if(seAll.is(":checked")){
                    $('.item-check').prop('checked', true);
                }
                else $('.item-check').prop('checked', false);
            })
             
            //ckeditor
            CKEDITOR.replace('note-order');
            // CKEDITOR.replace('edit-order-note');
            // var editor = $( '#edit-order-note' ).ckeditor();

            $('.item-check, .quantity-product, #selectAllProduct').on('keypress change', function(e){
                update_amount();
                updateInputQtyTotal();
            })

            function update_amount() {
                var total_quantity = 0;
                var sum = 0;
                $('.item_order').each(function(){
                    var checkboxItem =  $(this).find('.item-check');
                    var isChecked = checkboxItem.is(':checked');
                    if(isChecked){
                        var quantity = $(this).find('.quantity-product');
                        quantity.attr("disabled", false);
                        var price = $(this).find('.item-check').val();
                        var qty = quantity.val();
                        console.log(qty,price);
                        sum += price*qty;
                        total_quantity += 1*qty;
                    }  
                })
                $("#total-quantity").text(total_quantity);
                $('#order_total_amount').text(sum);
            }

            function updateInputQtyTotal(){
                $("#update-quantity-order").val($("#total-quantity").text());
                $("#update-total-order").val($("#order_total_amount").text());
            }

            updateInputQtyTotal();
            $(document).on('click','#close-detail-order',function(){
                $('#order-detail-modal').hide();
            })    
            $(document).on('click','.btn-cancel-form',function() {
                $('#order-detail-modal').hide();
            })
            
            $(document).on('click','.item-check-selected',function(){
                
            })

            $(document).on('keypress change', '.item-check-selected, .quantity-product-edit', function(){
                update_amount_edit();
            })
        
            function update_amount_edit() {
                var total_quantity = 0;
                var sum = 0;
                $('.item_order_edit').each(function(){
                    var checkboxItem =  $(this).find('.item-check-selected');
                    var isChecked = checkboxItem.is(':checked');
                    if(isChecked){
                        var quantity = $(this).find('.quantity-product-edit');
                        quantity.attr("disabled", false);
                        var price = $(this).find('.item-check-selected').val();
                        var qty = quantity.val();
                        console.log(qty,price);
                        sum += price*qty;
                        total_quantity += 1*qty;
                    }  
                })
                $("#edit-order-qty").val(total_quantity);
                $('#edit-order-total').val(sum);
            }
        };

        this.bindEvents = function () {
            initSubmit();
            createOrder();
            getListContent();
            deltetOrder();
            detailOrder();
            updateOrder();
        };

        this.resize = function () {

        };
        
        var initSubmit = function () {

        }

        var createOrder = function(){
            $('#form-order').submit(function(event){
                event.preventDefault();
                var formData = new FormData(this);
                console.log('formData'+formData);
                console.log('test',$('#file-avatar').prop("files")[0]);
                var file_avatar = $('#file-avatar').prop("files")[0];
                if(file_avatar != undefined){
                    formData.append('avatar', file_avatar);
                }
                
                try {
                    $.ajax({
                        type:'post',
                        url:'/order/create',
                        dataType:'json',
                        contentType: false,
                        processData: false,
                        loading: true,
                        data: formData,
                        success: function(res){
                            alert("Created order")
                            getListContent();
                            $('.modal').css("display", "none");          
                        }, 
                        error: function(res) {
                            $("#noti_err").empty();
                            var er =  res.responseJSON.errors;
                            for (const property in er) {
                                $("#noti_err").append(`
                                <div role="alert" aria-live="assertive" aria-atomic="true" class="toast" data-autohide="true"  data-delay="0" style="">
                                        <div class="toast-header">
                                            <strong class="mr-auto">Error</strong>
                                            <small><?php echo " " . date("h:i:sa"); ?></small>
                                            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="toast-body">
                                            ${property}  ${er[property]}
                                        </div>
                                    </div>`
                                    )
                            }
                            $(".toast").toast('show');
                        }
                    })
                } catch (e) {
                    alert('' + e.message);
                }
            });
        }

        var getListContent = function () {
            try {
                var data = {};
                $.ajax({
                    type: 'POST',
                    url: '/order/getOrders',
                    dataType: 'html',
                    loading: true,
                    data: data,
                    success: function (res) {
                        $("#orders").empty();
                        $("#orders").append(res);
                    },
                    // Ajax error
                    error: function (res) {
    
                    }
                });
            } catch (e) {
                alert('' + e.message);
            }
        }

        var deltetOrder = function(){
            $(document).on('click', '.order-delete-btn', function () {
                try {
                    alert(this.getAttribute('data-order'))
                    var data ={};
                        data['id'] = this.getAttribute('data-order');
                        $.ajax({
                            type:'post',
                            url : '/order/delete',
                            dataType: 'json',
                            loading: true,
                            data:data,
                            success: function(res){
                                switch(res['status']){
                                    case '200':
                                        getListContent();
                                        break;
                                }
                            }
                        })
                } catch (e) {
                    alert('delete err' + e.message);
                }
            });
        }

        var updateOrder = function(){
            $(document).on('submit','#order-show', function(){
                event.preventDefault();
                var formDataUpdate = new FormData(this);
                console.log('formData'+formDataUpdate);
                console.log('test img',$('#edit-upload-order-avt').prop("files")[0]);
                var file_avatar = $('#edit-upload-order-avt').prop("files")[0];
                if(file_avatar != undefined){
                    formDataUpdate.append('avatar', file_avatar);
                }else{
                    // formDataUpdate.append('avatar', $('#edit-order-avt'));
                }
                console.log($('#edit-order-avt'),$('#edit-upload-order-avt') );
                var q = $('.quantity-product-edit-order');
                for(var z=0;z<q.length; z++){
                    if(q[z].value){
                        formDataUpdate.append(q[z].getAttribute('name'),q[z].value);
                        console.log(q[z].getAttribute('name'),q[z].value);
                    }
                }
                try {
                    $.ajax({
                        type:'post',
                        url:'/order/update',
                        dataType:'json',
                        contentType: false,
                        processData: false,
                        loading: true,
                        data: formDataUpdate,
                        success: function(res){
                            alert("Updated order")
                            getListContent();
                            $('.modal').css("display", "none");          
                        }, 
                        error: function(res) {
                            $("#update_noti_err").empty();
                            var er =  res.responseJSON.errors;
                            for (const property in er) {
                                $("#update_noti_err").append(`
                                <div role="alert" aria-live="assertive" aria-atomic="true" class="toast" data-autohide="true"  data-delay="0" style="">
                                    <div class="toast-header">
                                        <strong class="mr-auto">Error</strong>
                                        <small><?php echo " " . date("h:i:sa"); ?></small>
                                        <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="toast-body">
                                        ${property}  ${er[property]}
                                    </div>
                                </div>`
                                )
                            }
                            $(".toast").toast('show');
                        }
                    })
                } catch (e) {
                    alert('' + e.message);
                }
            })
        }

        var detailOrder = function(){
            $(document).on('click', '.btn-detail-order', function () {
                $('#order-detail-modal').show();
                console.log('selected idOrder' , $(this).attr('data-order'))
                var data = {};
                data['id']= $(this).attr('data-order');
                try {
                    $.ajax({
                        type:'post',
                        url:'/order/show',
                        dataType:'html',
                        loading: true,
                        data: data,
                        success: function(res){
                            $('#order-detail-modal').html(res);
                        }, 
                        error: function(res) {
                        }
                    })
                } catch (e) {
                    alert('' + e.message);
                }
            })
        }

    };

    $(document).ready(function () {
        var homeObj = new homeCls();
        homeObj.run();
        // initEvents();
        // On resize
        $(window).resize(function () {
          homeObj.resize();
        });
    });
    
}(jQuery, $.app));
