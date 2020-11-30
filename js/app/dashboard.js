if ($().DataTable) {
    $("#data-table-simple").DataTable({
        //"order": [[ 0, "asc" ]],
        "ajax": "http://" + usourl + "/php/dashboard.func.php?job=get_tablero_empleados",   
        "columns": [      
            { "data": "empleada" },
            { "data": "domingo" },
            { "data": "lunes" },
            { "data": "martes" },
            { "data": "miercoles" },
            { "data": "jueves" },        
            { "data": "viernes" },
            { "data": "sabado" }
        ],   
        searching: false,
        bLengthChange: false,
        destroy: true,
        info: false,
        sDom:
            '<"row view-filter"<"col-sm-12"<"pull-left"l><"pull-right"f><"clearfix">>>t<"row view-pager"<"col-sm-12"<"text-center"ip>>>',
        pageLength: 6,
        language: {
            paginate: {
            previous: "<i class='simple-icon-arrow-left'></i>",
            next: "<i class='simple-icon-arrow-right'></i>"
            }
        },

        drawCallback: function() {
            $($(".dataTables_wrapper .pagination li:first-of-type"))
            .find("a")
            .addClass("prev");
            $($(".dataTables_wrapper .pagination li:last-of-type"))
            .find("a")
            .addClass("next");

            $(".dataTables_wrapper .pagination").addClass("pagination-sm");
        }
    });
}