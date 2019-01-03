package pt.amsi.ipleiria.pet4all.Models;

public class Size {
    public final static String DB_NAME = "animal";
    private int id;
    private String size;

    public int getId() {
        return this.id;
    }
    public String getSize() {
        return this.size;
    }

    public Size(){}

    public Size(String size){
        this.size = size;
    }


}