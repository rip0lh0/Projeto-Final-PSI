package pt.amsi.ipleiria.pet4all.Models;

import java.util.Date;

public class Local {
    public final static String DB_NAME = "animal";

    private int id;
    private Local local;
    private String name;


    public int getId() {
        return this.id;
    }
    public Local getLocal() {
        return this.local;
    }
    public String getName() {
        return this.name;
    }
}