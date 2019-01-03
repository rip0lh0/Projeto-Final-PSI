package pt.amsi.ipleiria.pet4all.Models;

import java.sql.Time;
import java.util.Date;

public class Schedule {
    public final static String DB_NAME = "animal";

    private int id;
    private Kennel kennel;
    private int day;
    private Time open_time;
    private Time close_time;


    public int getId() {
        return this.id;
    }

    public Kennel kennel() {
        return this.kennel;
    }

    public int getDayday() {
        return this.day;
    }

    public Time getOpen_time() {
        return this.open_time;
    }

    public Time getClose_time() {
        return this.close_time;
    }

}