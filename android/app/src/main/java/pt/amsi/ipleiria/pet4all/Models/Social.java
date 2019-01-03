package pt.amsi.ipleiria.pet4all.Models;

import java.util.Date;

public class Social {
    public final static String DB_NAME = "animal";

    private int id;
    private String facebook;
    private String instagram;
    private String youtube;


    public int getId() {
        return this.id;
    }

    public String getFacebook() {
        return this.facebook;
    }

    public String getInstagram() {
        return this.instagram;
    }

    public String getYoutube() {
        return this.youtube;
    }

}