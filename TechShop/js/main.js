$(function() {
    $('.button').on('click',function(){
        let id = $(this).data('id');
        let summ_usd = $(this).data('price_usd');
        let summ_eur = $(this).data('price_eur');


        $('.summ_price_usd').html(summ_usd);
        $('.summ_price_eur').html(summ_eur);
        
    });
});
