# # JobsIdFormGet200ResponsePayloadFieldsInner

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**name** | **string** | Hodnota HTML atributu \&quot;name\&quot;. | [optional]
**type** | **string** | Hodnota HTML atributu \&quot;type\&quot;. V případě hodnoty \&quot;select\&quot; se jedná o selectbox, v případě \&quot;select:m\&quot; se jedná o multichoice selectbox. V případě hodnoty \&quot;textarea\&quot; se jedná o textové pole. Email a URL jsou HTML5 inputy, které umožňují vestavěnou validaci, jinak lze nahradit za \&quot;text\&quot;. | [optional]
**label** | **string** | Label HTML inputu. | [optional]
**value** | **string** | Defaultní hodnota inputu. Vždy jako jedna hodnota, i v případě multichoice selectu. | [optional]
**input_options** | **object** | Dodatečné HTML atributy inputu, můžou být přednastavené data atributy. Multidimenzionální pole/objekt. Např. [data &#x3D;&gt; [cf &#x3D;&gt; date]] je třeba transformovat na data-cf&#x3D;date. | [optional]
**required** | **bool** | Udává, zda je input povinný. | [optional]
**hidden** | **bool** | Udává, zda má být prvek skrytý. | [optional]
**options** | **object** | Objekt s hodnotami pro selectbox, tj. jednotlivé options. Ve formátu label &#x3D;&gt; value. | [optional]
**order** | **int** | Pořadí inputu ve formuláři. | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
