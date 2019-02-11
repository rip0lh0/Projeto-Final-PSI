package pt.amsi.ipleiria.pet4all.Helpers;

import java.sql.Date;
import java.text.Format;
import java.text.SimpleDateFormat;

public class DateHelper {
    public static String ConvertDate(long timestamp){
        Date date = new Date(timestamp * 1000);
        Format format = new SimpleDateFormat("yyyy MM dd HH:mm:ss");

        return format.format(date);
    }
}
