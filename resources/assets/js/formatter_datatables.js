var formatter = {

    bool: function(table, td, cell_data, row_data, row_index, col_index) {
        return cell_data ? '<i style="color: green;" class="fa fa-circle"></i>' : '<i style="color: red;" class="fa fa-circle"></i>';
    },

    user_enabled: function(table, td, cell_data, row_data, row_index, col_index) {
        var ret = "";

        if(cell_data) {
            ret = '<button data-interaction="enable" data-disable="1" class="btn btn-xs btn-success"><i class="fa fa-check"></i></button>'
        } else {
            ret = '<button data-interaction="enable" class="btn btn-xs btn-danger"><i class="fa fa-times"></i></button>'
        }

        return ret;
    }
    
};