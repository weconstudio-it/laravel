var formatter = {
    bool: function(cell_data, row_data) {
        return cell_data ? '<i style="color: green;" class="fa fa-circle"></i>' : '<i style="color: red;" class="fa fa-circle"></i>';
    }
};