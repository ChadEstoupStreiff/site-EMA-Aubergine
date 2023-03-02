let table = null;
window.onload = function() {
    table = new Tab("tab-users", [], user_actions);
    table.update();
}