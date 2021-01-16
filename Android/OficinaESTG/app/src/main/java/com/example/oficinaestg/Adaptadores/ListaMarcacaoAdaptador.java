package com.example.oficinaestg.Adaptadores;

import android.content.Context;
import android.graphics.Color;
import android.graphics.drawable.Drawable;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.LinearLayout;
import android.widget.TextView;

import com.example.oficinaestg.Modelos.Marcacao;
import com.example.oficinaestg.R;

import java.util.ArrayList;

public class ListaMarcacaoAdaptador extends BaseAdapter {

   private Context context;
   private LayoutInflater layoutInflater;
   private ArrayList<Marcacao> marcacoes;
   private LinearLayout layoutMarc;
   private TextView tipo_text, data_text, estado_text;

    public ListaMarcacaoAdaptador(Context context, ArrayList<Marcacao> marcacoes) {
        this.context = context;
        this.marcacoes = marcacoes;
    }

    @Override
    public int getCount() {
        return marcacoes.size();
    }

    @Override
    public Object getItem(int position) {
        return marcacoes.get(position);
    }

    @Override
    public long getItemId(int position) {
        return position;
    }

    @Override
    public View getView(int position, View convertView, ViewGroup viewGroup) {
        if(layoutInflater == null){
            layoutInflater = (LayoutInflater) context.getSystemService(Context.LAYOUT_INFLATER_SERVICE);
        }
        if(convertView == null){
            convertView = layoutInflater.inflate(R.layout.item_lista_marcacao, null);
        }

        ListaMarcacaoAdaptador.ViewHolderLista viewHolderLista = (ListaMarcacaoAdaptador.ViewHolderLista) convertView.getTag();
        if(viewHolderLista == null){
            viewHolderLista = new ListaMarcacaoAdaptador.ViewHolderLista(convertView);
            convertView.setTag(viewHolderLista);
        }

        viewHolderLista.update(marcacoes.get(position));
        return convertView;
    }

    private class ViewHolderLista{

        private TextView Tipo, Data, Estado;

        public ViewHolderLista(View convertView){
            Tipo = convertView.findViewById(R.id.textView_tipoMarcacao);
            Data = convertView.findViewById(R.id.textView_dataMarcacao);
            Estado = convertView.findViewById(R.id.textView_estado);
            layoutMarc = convertView.findViewById(R.id.layoutMarc);

            tipo_text = convertView.findViewById(R.id.tipo_text);
            data_text = convertView.findViewById(R.id.data_text);
            estado_text = convertView.findViewById(R.id.estado_text);

        }

        public void update(Marcacao marcacao){
            Tipo.setText(marcacao.getTipoMarcacao());
            Data.setText(marcacao.getDataMarcacao());
            Estado.setText(marcacao.getEstadoMarcacao());

            String estado = marcacao.getEstadoMarcacao();

            if (estado.equals("Concluida")){
                layoutMarc.setBackgroundColor(Color.parseColor("#3eb85f"));

                Tipo.setTextColor(Color.parseColor("#FFFFFF"));
                Data.setTextColor(Color.parseColor("#FFFFFF"));
                Estado.setTextColor(Color.parseColor("#FFFFFF"));

                tipo_text.setTextColor(Color.parseColor("#FFFFFF"));
                data_text.setTextColor(Color.parseColor("#FFFFFF"));
                estado_text.setTextColor(Color.parseColor("#FFFFFF"));

            }else if (estado.equals("Rejeitada")){
                layoutMarc.setBackgroundColor(Color.parseColor("#e62012"));

                Tipo.setTextColor(Color.parseColor("#FFFFFF"));
                Data.setTextColor(Color.parseColor("#FFFFFF"));
                Estado.setTextColor(Color.parseColor("#FFFFFF"));

                tipo_text.setTextColor(Color.parseColor("#FFFFFF"));
                data_text.setTextColor(Color.parseColor("#FFFFFF"));
                estado_text.setTextColor(Color.parseColor("#FFFFFF"));

            }else{
                layoutMarc.setBackgroundColor(Color.parseColor("#FFFFFF"));

                Tipo.setTextColor(Color.parseColor("#000000"));
                Data.setTextColor(Color.parseColor("#000000"));
                Estado.setTextColor(Color.parseColor("#000000"));

                tipo_text.setTextColor(Color.parseColor("#000000"));
                data_text.setTextColor(Color.parseColor("#000000"));
                estado_text.setTextColor(Color.parseColor("#000000"));
            }
        }

    }
}
