describe('Ext.Panel', function () {
    var panel, header;

    var createPanel = function (config) {
        panel = Ext.create('Ext.Panel', config || {});
        header = panel.getHeader();
    };


    afterEach(function () {
        panel = header = Ext.destroy(panel, header);
    });

    describe("configuration", function () {
        describe("title", function () {
            it("should not create a header no title is provided", function () {
                createPanel();

                expect(header).toBe(null);
            });

            it("should create a header if title is provided", function () {
                createPanel({
                    title: 'Foo'
                });

                expect(header.getTitle().getText()).toBe('Foo');
            });

            it("should not create header if title is provided, but header:false", function () {
                createPanel({
                    title: 'Foo',
                    header: false
                });

                expect(header).toBe(null);
            });
        });
    });

    describe("methods", function () {
        describe("setTitle", function () {
            it("should update title when a header exists", function () {
                createPanel({
                    title: 'Foo'
                });

                panel.setTitle('Bar');

                expect(header.getTitle().getText()).toBe('Bar');
            });

            it("should not create a header when header:false", function () {
                createPanel({
                    title: 'Foo',
                    header: false
                });

                panel.setTitle('Bar');

                expect(header).toBe(null);
            });
        });
    });
});
