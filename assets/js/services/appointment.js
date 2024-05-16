var AppointmentService = {
    reload_appointment_datatable: function() {
        Utils.get_datatable("admin-table-appointments", Constants.API_BASE_URL + "appointments",
            [
                { data: "action" }, // Pretpostavka: kolona sa akcijama (brisanje, izmena)
                { data: "patient_id" }, // Pretpostavka: kolona za ID pacijenta
                { data: "doctor_id" }, // Pretpostavka: kolona za ID doktora
                { data: "appointment_date" }, // Pretpostavka: kolona za datum pregleda
                { data: "status" } // Pretpostavka: kolona za status pregleda
            ],
            null,
            function() {
                console.log("Datatable drawn");
            }
        );
    },
    delete_appointment: function(appointment_id) {
        if (confirm("Are you sure you want to delete the appointment with ID " + appointment_id + "?")) {
            RestClient.delete(
                "delete_appointment.php?id=" + appointment_id,
                {},
                function(data) {
                    AppointmentService.reload_appointment_datatable();
                    console.log("Deleted data: " + data);
                },
                function(error) {
                    console.log(error);
                }
            );
        } else {
            console.log("Dismissed!"); // Dodata poruka u slučaju odbijanja brisanja
        }
    },
};
