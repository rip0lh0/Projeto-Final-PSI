package pt.amsi.ipleiria.pet4all.Models;

import java.util.Date;

public class Contact {
    public final static String DB_NAME = "animal";

    private int id;
    private Double phone;
    private Double cellphone;
    private Double fax;
    private Date updated_at;

    public int getId() {
        return this.id;
    }

    public Double getCellphone() {
        return this.cellphone;
    }

    public Double getPhone() {
        return this.phone;
    }

    public Double getFax() {
        return this.fax;
    }

    public Date getUpdated_at() {
        return this.updated_at;
    }
}