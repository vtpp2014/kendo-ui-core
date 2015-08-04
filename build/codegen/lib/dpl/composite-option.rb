require 'codegen/lib/dpl/options'

module CodeGen::DPL::Options

    class CompositeOption < CodeGen::CompositeOption
        include CodeGen::DPL::Options

        DECLARATION = ERB.new(File.read("build/codegen/lib/dpl/templates/composite-option-declaration.erb"), 0, '%<>')

        def csharp_class
            "#{csharp_name}"
        end

        def csharp_class_name
            "#{csharp_class}"
        end

        def to_declaration
            DECLARATION.result(binding)
        end

    end

end
