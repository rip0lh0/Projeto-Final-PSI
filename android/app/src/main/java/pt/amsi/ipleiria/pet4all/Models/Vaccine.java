package pt.amsi.ipleiria.pet4all.Models;

import java.util.Date;

public class Vaccine {
    public final static String DB_NAME = "animal";
    private int id;
    private Treatment treatment;
    private String vaccine;
    private Date date;

    public int getId() {
        return this.id;
    }
    public Treatment getTreatment() {
        return this.treatment;
    }
    public String getVaccine() {
        return this.vaccine;
    }
    public Date getDate() {
        return this.date;
    }


}