<footer class="footer">
    <div class="container-fluid">
        <div class="row text-muted">
            <div class="col-6 text-left">
                <ul class="list-inline">
                    <li class="list-inline-item">
                        <a class="text-muted" href="#">Support</a>
                    </li>
                    <li class="list-inline-item">
                        <a class="text-muted" href="#">Help Center</a>
                    </li>
                    <li class="list-inline-item">
                        <a class="text-muted" href="#">Privacy</a>
                    </li>
                    <li class="list-inline-item">
                        <a class="text-muted" href="#">Terms of Service</a>
                    </li>
                </ul>
            </div>
            <div class="col-6 text-right">
                <p class="mb-0">
                    &copy; 2022 - <a href="abraa.com" class="text-muted">Abraa</a>
                </p>
            </div>
        </div>
    </div>
</footer>


</div>
    </div>

    <script src="<?php echo e(asset('js/app.js')); ?>"></script>
    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>

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
                responsive: true,
                // "scrollX": true, 
                "bPaginate": false,
                //"scrollY": 200,
                "scrollTop": true,
                "searching": false
                "aoColumnDefs": [
                    { "bSortable": false, "aTargets": [ 0, 1, 2, 3 ] }, 
                    { "bSearchable": false, "aTargets": [ 0, 1, 2, 3 ] }
                ] 
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
            showDropdowns: true
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
			var editor = new Quill("#quill-editor", {
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

    <script src="<?php echo e(asset('js/form_steps.js')); ?>"></script>

    <script src="<?php echo e(asset('js/form_steps.js')); ?>"></script>

    <script src="<?php echo e(asset('js/add_store.js')); ?>"></script>

    <script src="<?php echo e(asset('js/dataTables/suppliersDataTable.js')); ?>"></script>

    <script src="<?php echo e(asset('js/dataTables/buyersDataTable.js')); ?>"></script>

    <script src="<?php echo e(asset('js/dataTables/itemsDataTable.js')); ?>"></script>

    <script src="<?php echo e(asset('js/dataTables/storesDataTable.js')); ?>"></script>

    <script src="<?php echo e(asset('js/dataTables/rfqsDataTable.js')); ?>"></script>

    <script src="<?php echo e(asset('js/dataTables/categoriesDataTable.js')); ?>"></script>

    <script src="<?php echo e(asset('js/dataTables/shippersDataTable.js')); ?>"></script>

</body>

</html>

<?php /**PATH C:\wamp64\www\abraa-dash\resources\views/admin/layouts/footer.blade.php ENDPATH**/ ?>