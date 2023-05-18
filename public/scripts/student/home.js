
window.onload = () => {
    console.log(overview);
};



$(document).ready(function () {
    var table = $('#table').DataTable({
        scrollX: true,
        data: overview,
        columns: [
            { data: 'id'},
            { data: 'file_name' },
            { data: 'task_name' },
            { data: 'generated_at' },
            { data: 'submitted_at'},
            {
                data: 'submitted_at',
                render: function (data, type, row){
                    if (type === 'display'){
                        if (data === null){
                            //var routeUrl = "{{ route('student.generate') }}";
                            routeEditorId = routeEditor.replace('/1', '/'+row.id);
                            //console.log(routeEditorId);
                            return '<a href="' + routeEditorId + '">Vypočítať</a>';
                        }else {
                            return null;
                        }
                    }
                    return data;
                },
            },
        ],
        "lengthMenu": [ [5, 10, 20, -1], [5, 10, 20, "All"] ],
        "language": {
            "lengthMenu": "Zobraziť _MENU_ záznamov na stránku",
            "info": "Zobrazujem _START_ - _END_ z celkovo _TOTAL_ záznamov",
            "search": "Hľadať:",
            "paginate": {
                "first":      "Prvá",
                "last":       "Posledná",
                "next":       "Ďalšia",
                "previous":   "Predošlá"
            },
        }
    });
});


function ischecked() {
    let isSomeChecked = false;
    var checkBoxes = document.getElementsByClassName("checkBoxes");
    for (let i = 0; i<checkBoxes.length; i++){
        if (checkBoxes[i].checked){
            isSomeChecked = true;
            break;
        }
    }
    if (isSomeChecked){
        document.getElementById("generate-btn").style.display = "block";
    }else {
        document.getElementById("generate-btn").style.display = "none";
    }
}


