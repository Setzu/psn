/**
 * Created by david on 22/08/17.
 */
$(document).ready(function() {
    alert('Javascript chargé !');
    var _type = $('#type-mouvement');
    _type.change(function() {
        alert('test');
    });
    if (_type.val() === 'virement' ) {
        alert('test');
    }
});