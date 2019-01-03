package pt.amsi.ipleiria.pet4all.Models;

import java.util.Date;

public class Adopter {
    public final static String DB_NAME = "animal";

    private int id;
    private String name;
    private Double cellphone;

    public int getId() {
        return this.id;
    }
    public String getName() {
        return this.name;
    }
    public Double getCellphone() {
        return this.cellphone;
    }
}