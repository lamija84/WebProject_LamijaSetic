var UserService = {
    reload_user_datatable: function() {
        Utils.get_datatable("admin-table-users", Constants.API_BASE_URL + "users", // Pretpostavka: API ruta za dobavljanje korisnika
            [
                { data: "action" }, // Pretpostavka: kolona sa akcijama (brisanje)
                { data: "id" }, // Pretpostavka: kolona za ID korisnika
                { data: "first_name" }, // Pretpostavka: kolona za ime korisnika
                { data: "last_name" }, // Pretpostavka: kolona za prezime korisnika
                { data: "email" }, // Pretpostavka: kolona za email korisnika
                { data: "is_admin" }, // Pretpostavka: kolona za označavanje admina
                { data: "created_at" } // Pretpostavka: kolona za datum kreiranja korisnika
            ],
            null,
            function() {
                console.log("Datatable drawn");
            }
        );
    },
    delete_user: function(user_id) {
        if (confirm("Are you sure you want to delete the user with ID " + user_id + "?")) {
            RestClient.delete(
                "delete_user.php?id=" + user_id,
                {},
                function(data) {
                    UserService.reload_user_datatable();
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
