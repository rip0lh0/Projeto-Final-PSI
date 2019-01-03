package pt.amsi.ipleiria.pet4all.Models;

import java.util.Date;

public class Kennel {
    public final static String DB_NAME = "animal";

    private int id;
    private User user;
    private Contact contact;
    private Social social;
    private String name;
    private int nif;
    private String address;


    public int getId() {
        return this.id;
    }

    public User getUser() {
        return this.user;
    }

    public Contact getContact() {
        return this.contact;
    }

    public Social getSocial() {
        return this.social;
    }

    public String getName() {
        return this.name;
    }

    public int getNif() {
        return this.nif;
    }

    public String getAddress() {
        return this.address;
    }
}