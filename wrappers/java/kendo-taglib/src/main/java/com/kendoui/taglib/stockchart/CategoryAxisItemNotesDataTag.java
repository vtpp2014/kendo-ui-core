
package com.kendoui.taglib.stockchart;


import com.kendoui.taglib.BaseTag;
import com.kendoui.taglib.stockchart.CategoryAxisItemNotesTag;
import java.util.ArrayList;
import java.util.Map;
import java.util.List;

import javax.servlet.jsp.JspException;

@SuppressWarnings("serial")
public class CategoryAxisItemNotesDataTag extends BaseTag /* interfaces */ /* interfaces */ {
    
    @Override
    public int doEndTag() throws JspException {
//>> doEndTag
//<< doEndTag
        
        CategoryAxisItemNotesTag parent = (CategoryAxisItemNotesTag)findParentWithClass(CategoryAxisItemNotesTag.class);

        parent.setData(this);

        return super.doEndTag();
    }

    @Override
    public void initialize() {
//>> initialize

        data = new ArrayList<Map<String, Object>>();

//<< initialize

        super.initialize();
    }

    @Override
    public void destroy() {
//>> destroy
//<< destroy

        super.destroy();
    }

//>> Attributes

    private List<Map<String, Object>> data;

    public List<Map<String, Object>> data() {
        return data;
    }

    public static String tagName() {
        return "stockChart-categoryAxisItem-notes-data";
    }

    public void addDataItem(CategoryAxisItemNotesDataItemTag value) {
        data.add(value.properties());
    }

//<< Attributes

}