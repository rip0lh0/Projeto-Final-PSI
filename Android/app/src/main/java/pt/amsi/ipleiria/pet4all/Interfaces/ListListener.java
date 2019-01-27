package pt.amsi.ipleiria.pet4all.Interfaces;

import java.util.ArrayList;

public interface ListListener<T> {
    public void onRefreshList(ArrayList<T> list);
    public void onUpdateList(T item, int operacao);
}
