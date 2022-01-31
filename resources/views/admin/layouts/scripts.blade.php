<script src="{{ asset('js/app.js') }}"></script>
<script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>

<script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js" ></script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Bar chart
        new Chart(document.getElementById("chartjs-dashboard-bar"), {
            type: "bar",
            data: {
                labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                datasets: [{
                    label: "Last year",
                    backgroundColor: window.theme.primary,
                    borderColor: window.theme.primary,
                    hoverBackgroundColor: window.theme.primary,
                    hoverBorderColor: window.theme.primary,
                    data: [54, 67, 41, 55, 62, 45, 55, 73, 60, 76, 48, 79],
                    barPercentage: .325,
                    categoryPercentage: .5
                }, {
                    label: "This year",
                    backgroundColor: window.theme["primary-light"],
                    borderColor: window.theme["primary-light"],
                    hoverBackgroundColor: window.theme["primary-light"],
                    hoverBorderColor: window.theme["primary-light"],
                    data: [69, 66, 24, 48, 52, 51, 44, 53, 62, 79, 51, 68],
                    barPercentage: .325,
                    categoryPercentage: .5
                }]
            },
            options: {
                maintainAspectRatio: false,
                cornerRadius: 15,
                legend: {
                    display: false
                },
                scales: {
                    yAxes: [{
                        gridLines: {
                            display: false
                        },
                        stacked: false,
                        ticks: {
                            stepSize: 20
                        },
                        stacked: true,
                    }],
                    xAxes: [{
                        stacked: false,
                        gridLines: {
                            color: "transparent"
                        },
                        stacked: true,
                    }]
                }
            }
        });
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        $("#datetimepicker-dashboard").datetimepicker({
            inline: true,
            sideBySide: false,
            format: "L"
        });
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Pie chart
        new Chart(document.getElementById("chartjs-dashboard-pie"), {
            type: "pie",
            data: {
                labels: ["Direct", "Affiliate", "E-mail", "Other"],
                datasets: [{
                    data: [2602, 1253, 541, 1465],
                    backgroundColor: [
                        window.theme.primary,
                        window.theme.warning,
                        window.theme.danger,
                        "#E8EAED"
                    ],
                    borderWidth: 5,
                    borderColor: window.theme.white
                }]
            },
            options: {
                responsive: !window.MSInputMethodContext,
                maintainAspectRatio: false,
                cutoutPercentage: 70,
                legend: {
                    display: false
                }
            }
        });
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        $("#datatables-dashboard-projects").DataTable({
            pageLength: 6,
            lengthChange: false,
            bFilter: false,
            autoWidth: false
        });
    });
</script>


<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Datatables Responsive
        $("#datatables-reponsive").DataTable({
            "responsive": true,
            "scrollX": true, 
            "bPaginate": false,
            //"scrollY": 200, 
            "searching": false,
            "ordering": false,
            "bInfo": false,
        });
    });
</script>
 

<script>
    $('.select2').select2({
        tags: true,
    });
</script>

<script>
    $(".datepicker").daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
    });

    $(".ymd_datepicker").daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
        locale: {
            format: "Y-M-D"
        }
    });
</script>

<script>
        $(document).ready(function(){
        $('.select_all_colums').click(function(){
            if($(this).is(":checked")){
                $('input[type="checkbox"]').prop('checked', true);
            }
            else if($(this).is(":not(:checked)")){ 
                $('input[type="checkbox"]').prop('checked', false);
            }
        });
    });
</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        if (!window.Quill) {
            return $("#quill-editor,#quill-toolbar,#quill-bubble-editor,#quill-bubble-toolbar").remove();
        }
        var editor = new Quill(".quill-editor", { 
            modules: {
                toolbar: "#quill-toolbar"
            },
            placeholder: "Type something",
            theme: "snow"
        });
        var bubbleEditor = new Quill("#quill-bubble-editor", {
            placeholder: "Compose an epic...",
            modules: {
                toolbar: "#quill-bubble-toolbar"
            },
            theme: "bubble"
        });
    });
</script>

<script type="text/javascript">
    $(window).on('load', function() {
        $('#feedback_modal').modal('show');
    });
</script>

<script src="{{ asset('js/form_steps.js') }}"></script>










