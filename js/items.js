$(document).ready(function(){
    // Getting all the add to cart button
    $('.add-to-cart').click(function(){
	var foodId = $(this).parent().find(".food-id").text();
	$('tbody').load("./inc/total.inc.php",{
	    foodId: foodId 
	}, function(){
	    updateTotal();
	});
    });
    // update total if refresh page
    updateTotal();
    $('#login-load').click(function(){
	$('.row.row-wrap').load('login.php');
    });
});


// Removeing the cart table row
function removeTableRow(event){
    var foodId = $(event).parent().find('.food-id').text();
    //console.log(foodId);
    $('tbody').load("./inc/total.inc.php", {
	rmFoodId: foodId
    }, function(){
	updateTotal();
    });
}

// Updating the cart total 
function updateTotal(){
    // Getting the table row of item
    var itemRow = $('tbody tr');
    // console.log(itemRow);
    // Getting all the price of every row and calculating total
    var total = 0;
    itemRow.each(function(){
	var cartPrice = $(this).find('.food-price').text();
	var cartQuantity = $(this).find('.cart-quantity').val();
	//console.log(cartPrice, cartQuantity);
	var quantity = cartQuantity;
	// Chaking error 
	if (isNaN(quantity) || quantity <= 0) {
	    $(this).find('.cart-quantity').val(1);
	    quantity = 1;
	}
	total += parseFloat(cartPrice) * parseFloat(quantity);
	//console.log(total);
    });
    total = total.toFixed(2);
    $('#cart-total').val(total);
    $('.cart-total').text(total);
}

function quantityChange(event, valuequn){
    // Getting all the cart input tags
    var foodQn = parseInt(valuequn);
    if (foodQn <= 0) {
	foodQn = 1;
    }
    var foodId = $(event).parent().parent().find('.food-id').text();
    // console.log(foodQn);
    // console.log(foodId);
    $('tbody').load("./inc/total.inc.php",{
	foodId: foodId,
	foodQn: foodQn    
    }, function(){
	updateTotal();
    });
}

// Modal Code

// Get the button that opens the modal
$('#placeorder').click(function(){
    // When the user clicks the button, open the modal
    $('#myModal').css("display", "block");
});

// When the user clicks on <span> (x), close the modal
$('.close').click(function(){
    // When the user clicks the button, open the modal
    $('#myModal').css("display", "none");
});
