package pt.amsi.ipleiria.pet4all.Models;

public class Coat {
    public final static String DB_NAME = "animal";
    private int id;
    private String coat;

    public int getId() {
        return this.id;
    }
    public String getCoat() {
        return this.coat;
    }

    public Coat(){}

    public Coat(String coat){
        this.coat = coat;
    }


}
