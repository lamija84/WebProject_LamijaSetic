var PatientService = {
    open_edit_patient_modal: function (patient_id) {
      RestClient.get("get_patient.php?id=" + patient_id, function (data) {
        console.log("DATA IS ", data);
        $("#edit-patient-modal").modal("toggle"); // Pretpostavka: koristimo modal za izmjenu pacijenta
        $("#edit-patient-form input[name='id']").val(data.id); // Prilagođavanje imena polja prema backend-u
        $("#edit-patient-form input[name='name']").val(data.name); // Prilagođavanje imena polja prema backend-u
        $("#edit-patient-form input[name='email']").val(data.email); // Prilagođavanje imena polja prema backend-u
        $("#edit-patient-form input[name='created_at']").val(data.created_at); // Prilagođavanje imena polja prema backend-u
      });
    },
    delete_patient: function (id) {
      if (confirm("Are you sure you want to delete this patient?")) {
        RestClient.delete(
          "patients/delete" + id,
          { },
          function (data) {
            PatientService.reload_patients_table();
          }
        );
      } else {
        console.log("Dismissed!"); // Ispravljena greška u logovanju
      }
    },
    reload_patients_table: function() {
      Utils.get_datatable(
        "tbl_patients",
        Constants.API_BASE_URL + "patients/add", // Pretpostavka: API za dobavljanje pacijenata
        [
          { data: "action" }, // Pretpostavka: kolona sa akcijama (izmena, brisanje)
          { data: "name" }, // Pretpostavka: kolona za ime pacijenta
          { data: "date_of_birth" }, // Pretpostavka: kolona za datum rođenja pacijenta
          { data: "gender" }, // Pretpostavka: kolona za pol pacijenta
          { data: "contact_number" }, // Pretpostavka: kolona za kontakt telefon pacijenta
        ]
      );
    }
  };
  