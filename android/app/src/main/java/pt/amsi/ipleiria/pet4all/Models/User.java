package pt.amsi.ipleiria.pet4all.Models;

import java.util.Date;

public class User {
    public final static String DB_NAME = "animal";

    private int id;
    private Local local;
    private String username;
    private String password_hash;
    private String password_reset_token;
    private String email;
    private String auth_key;
    private int status;
    private Date created_at;
    private Date updated_at;


    public int getId() {
        return this.id;
    }
    public Local getLocal() {
        return this.local;
    }
    public String getUsername() {
        return this.username;
    }
    public String getPassword_hash() {
        return this.password_hash;
    }
    public String getPassword_reset_token() {
        return this.password_reset_token;
    }
    public String getEmail() {
        return this.email;
    }
    public String getAuth_key() {
        return this.auth_key;
    }
    public int getStatus() {
        return this.status;
    }
    public Date getCreated_at() {
        return this.created_at;
    }
    public Date getUpdated_at() {
        return this.updated_at;
    }
}